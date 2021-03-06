<?php

namespace App;

use PDO;

class Query
{

    private array $select = [];
    private $insert;
    private array $from;
    private array $where = [];
    private string $order;
    private int $limit = 0;
    private ?PDO $pdo;
    private array $params = [];
    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function from(string $table, ?string $alias = null): self
    {
        if($alias) {
            $this->from[$alias] = $table;
        } else {
            $this->from[] = $table;
        }
        return $this;
    }

    public function select(string ...$fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function where(string ...$condition): self
    {
        $this->where = array_merge($this->where, $condition);
        return $this;
    }

    public function count(): int
    {
        $this->select("COUNT(id)");
        return $statement = $this->execute()->fetchColumn();
    }

    public function params(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function toString(): string
    {
        $parts = ['SELECT'];
        if($this->select) {
            $parts[] = join(', ', $this->select);
        } else {
            $parts[] = '*';
        }
        $parts[] = 'FROM';
        $parts[] = $this->buildFrom();
        if(!empty($this->where)) {
            $parts[] = "WHERE";
            $parts[] = "(" . join(') AND (', $this->where) . ')';
        }
        return join(' ', $parts);
    }

    public function buildFrom(): string
    {
        $from = [];
        foreach ($this->from as $key => $value) {
            if(is_string($key)) {
                $from[] = "$value as $key";
            } else {
                $from[] = $value;
            }
        }
        return join(', ', $from);
    }

    public function execute()
    {
        $query = $this->toString();
        if($this->params) {
            $statement = $this->pdo->prepare($query);
            $statement->execute($this->params);
            return $statement;
        }
        return $this->pdo->query($query);
    }


}