<?php

class Model extends Database
{
    protected $table;
    public $errors = array();
    public function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . 's';
        }
    }

    public function where($column, $value)
    {
        // prévient les erreurs de syntaxe SQL et les attaques d'injection SQL
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value";
        return $this->query($query, [
            "value" => $value
        ]);
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    public function insert($data)
    {
        // supprime les colonnes non autorisées
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            };
        }

        // exécute les fonctions avant l'insertion
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            };
        }

        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = ':' . implode(', :', $keys);

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . ' = :' . $key . ',';
        }

        $str = trim($str, ',');

        $data['id'] = $id;
        $query = "update $this->table SET $str WHERE id = :id;";
        echo $query;
        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }
}
