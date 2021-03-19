<?php

namespace App\Query;

class TaskQuery extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM tasks ORDER BY date_limite ASC';
        $data = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function insert($data): void
    {
        $sql = 'INSERT INTO tasks VALUES(null, :title, :date_limite, 0, :id_type )';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':title' => $data['title'],
            ':date_limite' => $data['date_limite'],
            ':id_type' => $data['id_type'],
        ]);
    }

    public function update($data): void
    {
        $sql = 'UPDATE tasks SET title = :title, date_limite = :date_limite , id_type = :id_type WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $data['id'],
            ':title' => $data['title'],
            ':date_limite' => $data['date_limite'],
            ':id_type' => $data['id_type'],
        ]);
    }

    public function alterStatus($data): void
    {
        $sql = 'UPDATE tasks SET status_check = :status_check WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $data['id'],
            ':status_check' => $data['status_check']
        ]);
    }

    public function delete($id): void
    {
        $sql = 'DELETE FROM tasks WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $id
        ]);
    }
}
