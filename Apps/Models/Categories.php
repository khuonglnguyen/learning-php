<?php
class Apps_Models_Categories extends Apps_Libs_DbConnection
{
    protected $tableName = 'categories';

    public function buildSelectBox()
    {
        $query = $this->buildQueryParams([
            'select' => 'id,name'
        ])->select();
        $result = ['' => '-- select category --'];
        foreach ($query as $row) {
            $result[$row['id']] = $row['name'];
        }
        return $result;
    }
}
