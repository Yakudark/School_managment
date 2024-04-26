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

    public function where($column, $value, $orderby = 'desc')
    {
        // prévient les erreurs de syntaxe SQL et les attaques d'injection SQL
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value order by id $orderby";
        $data = $this->query($query, [
            "value" => $value
        ]);
        // exécute les fonctions après la sélection
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                };
            }
        }
        return $data;
    }

    public function first($column, $value, $orderby = 'desc')
    {
        // prévient les erreurs de syntaxe SQL et les attaques d'injection SQL
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value order by id $orderby";
        $data = $this->query($query, [
            "value" => $value
        ]);
        // exécute les fonctions après la sélection
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                };
            }
        }
        if (is_array($data)) {
            $data = $data[0];
        }
        return $data;
    }

    public function findAll($orderby = 'desc')
    {
        $query = "SELECT * FROM $this->table order by id $orderby";
        $data = $this->query($query);

        // exécute les fonctions après la sélection
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                };
            }
        }
        return $data;
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
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        if (property_exists($this, 'beforeUpdate')) {
            foreach ($this->beforeUpdate as $func) {
                $data = $this->$func($data);
            }
        }

        $str = "";
        foreach ($data as $key => $value) {
            // code...
            $str .= $key . "=:" . $key . ",";
        }

        $str = trim($str, ",");

        $data['id'] = $id;
        $query = "update $this->table set $str where id = :id";

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }
}
