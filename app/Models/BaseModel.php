<?php
namespace app\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class BaseModel extends Model
{

	public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
	{
        parent::__construct($db, $validation);
	}    

    public function getSessionVar($varName)
    {
        return session()->get($varName);
    }
    public function getCompannyId()
    {
        return $this->getSessionVar('Com_Id');
    }
    public function getRol()
    {
        return $this->getSessionVar('rol');
    }
    public function getUserId()
    {
        return $this->getSessionVar('id');
    }
    public function getRolEmpField()
    {
        $s = '';
        $rol = $this->getRol();
        if ($rol == ROLE_RBT)
            $s = EMPLOYEE_TYPE_RBT;
        if ($rol == ROLE_HHA)
            $s = EMPLOYEE_TYPE_HHA;            
        if ($rol == ROLE_BCaBA)
            $s = EMPLOYEE_TYPE_BCaBA;
        if ($rol == ROLE_BCBA)
            $s = EMPLOYEE_TYPE_BCBA;
        return $s;
    }
    public function getRolEmpChildField($check_type)  // 1 -> checking RBTs, 2 -> checking BCaBA
    {
        $s = '';
        $rol = $this->getRol();
        if ($rol == ROLE_RBT || $rol == ROLE_HHA)
            $s = '';
        if ($rol == ROLE_BCaBA)
            $s = EMPLOYEE_TYPE_RBT;
        if ($rol == ROLE_BCBA){
            if ($check_type == 1)
                $s = EMPLOYEE_TYPE_RBT;
            else
                $s = EMPLOYEE_TYPE_BCaBA;
        }
        return $s;
    }    
    public function getEmpId()
    {
        return $this->getSessionVar('Emp_Id');
    }
    public function canInvoice()
    {
        return $this->getSessionVar('canInvoice');
    }
    public function canNote()
    {
        return $this->getSessionVar('canNote');
    }    
    public function canAssessment()
    {
        return $this->getSessionVar('canAssessment');
    }

    public function getGridQuery($criteria = null, $perPage = 20, $offset = 0)
    {
        $criteriaSQL = $this->buildCriteriaSQL($criteria);
        $extra_conditionsSQL = $this->getExtraConditionsSQL();
        $orderBySQL = $this->buildOrderBySQL();
        $limitBySQL = $this->buildLimitSQL($perPage, $offset);

        return $this->getGridSQL().$criteriaSQL.' '.$extra_conditionsSQL.' '.$orderBySQL.' '.$limitBySQL;
    }

    public function getGridTotalsQuery($criteria = null)
    {
        return " SELECT ".$this->getGridTotalColumnsSQL()." FROM (".$this->getGridQuery($criteria, 0, 0).") MainQuery ";
    }    

    public function summarize($criteria = null)
    {

        $query = $this->getGridTotalsQuery($criteria, 0 , 0);

        return $this->db->query($query);
    }    



    public function getExportQuery($criteria = null)
    {
        $query = $this->getGridQuery($criteria, 0 , 0);
        return $this->db->query($query);
    }    
    
    public function getGridSQL()
    {
        return "";
    }

    public function getGridTotalColumnsSQL()
    {
        $columns = '';
        foreach ($this->getGridColumns() as $column) {
            if (!$column->getIsTotal()) continue;

            if (!empty($columns)) $columns .= ', ';
            $columns .= " SUM(".$column->getDbColumn().") AS ".$column->getDbColumn();
        }

        return $columns;
    }    

    public function getExtraConditionsSQL()
    {
        return "";
    }

    protected function getColumnSearch($columnsSearch, $name)
    {
        if (empty($columnsSearch)) return null;
        $column = null;

        foreach ($columnsSearch as $columnSearch)
        {
            $columnName = $columnSearch->getName();
            if ($columnName == substr($name, (-1 * strlen($columnName))))
            {
                $column = $columnSearch;
                break;
            }
        }
        return $column;
    }

    protected function buildOrderBySQL()
    {
        return "";
    }

    protected function buildLimitSQL($perPage = 20, $offset = 0)
    {
        if($perPage == 0 && $offset == 0) return '';
        return " LIMIT $offset, $perPage";
    }    

    protected function getExtraCriteria($criteria)
    {
        if (!isset($criteria) || empty($criteria) || !array_key_exists('grid_search_active', $criteria))
            return $criteria;

        if ((int)$criteria['grid_search_active'] != ACTIVE && (int)$criteria['grid_search_active'] != ONLY_INACTIVE ) {
            unset($criteria['grid_search_active']);
        }
        else if ((int)$criteria['grid_search_active'] == ACTIVE) {
            $criteria['grid_search_active'] = '1';
        }
        else if ((int)$criteria['grid_search_active'] == ONLY_INACTIVE) {
            $criteria['grid_search_active'] = '0';
        }
        return $criteria;
    }

    protected function buildCriteriaSQL($criteria = null)
    {
        $criteria = $this->getExtraCriteria($criteria);
        if ($criteria == null) 
            $criteria = $this->getDefaultCriteria();

        if ($criteria == null) return "";

        $s = "";
        $columnsSearch = $this->getGridColumnsSearch();
        
        foreach ($criteria as $key => $value)
        {
            $field = $this->getColumnSearch($columnsSearch, $key);
            if ($field != null){
                $s .= $this->getFilterFromColumn($field, $value);
            }
        }

        return $s;
    }

    protected function getFilterFromColumn($field, $value)
    {
        $fieldName = $field->getField();
        $fieldType = $field->getType();
        $isBool = $field->getIsBool();
        $for_late = $field->getForLate();

        $s = '';
        if ($for_late) return '';
        if (empty($value) && !$isBool) return '';
        if (!empty($fieldName)) {
            $prefix = '';
            if (strpos($fieldName, '.') == 0)
                $prefix = 't.';

            switch ($fieldType) {
                case 'TEXT':
                {
                    $s .= " AND " . $prefix . $fieldName . " like '%" . $value . "%'";
                    break;
                }
                case 'SELECT':
                {
                    $s .= " AND " . $prefix . $fieldName . " = " . $value;
                    break;
                }
            }
        }
        return $s;
    }

    protected function getDefaultCriteria()
    {
        $columns = $this->getGridColumnsSearch();

        if (empty($columns)) return [];
        $s = [];
        foreach ($columns as $field)
        {
            if ($field == null || empty($field->getDefaultValue())) continue;
            $s['grid_search_'.$field->getName()] = $field->getDefaultValue();
        }

        if (!empty($s))
            $s["grid_search_button"] = "";

        return $s;
    }    

    function getSQLConditionsFromArray($conditions)
    {
        $cond = '';
        foreach ($conditions as $field => $value) {
            $cond .= ' AND ';
            $cond .= $field . " = '" . $value . "'";
        }

        return $cond;
    }

    function getSQLOrderByFromArray($orderBy)
    {
        if (empty($orderBy)) return "";

        return " ORDER BY ".$orderBy['field'].' '.$orderBy['direction'];
    }

    function hasPermission($controller, $action)
    {
        return utils()->Can(session()->get('rol'), $controller, $action);
    }

    public function deleteForParent($parentId, $fkField)
    {
        $query = "DELETE FROM ".$this->table." WHERE ".$fkField." = ".$parentId;

        $this->db->query($query);
    }    

    function getFieldFromArray($conditions, $fieldName)
    {
        $fieldValue = '';
        foreach ($conditions as $field => $value) {
            if ($field == $fieldName) 
            {
                $fieldValue  = $value;
                break;
            }
        }

        return $fieldValue;
    }     

    public function findInSet($ids)
    {
        $query = "
            SELECT *
                FROM ".$this->table." 
                WHERE id IN (".$ids.")";

        return $this->db->query($query)->getResult($this->returnType);
    } 
    
    public function bulk_delete($ids)
    {
        $query = "DELETE FROM ".$this->table." WHERE id IN (".$ids.")";

        $this->db->query($query);
    }     

    public function getFirst($id = 0)
    {
        if ((int)$id == 0)
            return $this->first();

        return $this->where('id', $id)->first();
    }     


}