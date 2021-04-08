<?php

namespace App\Query;

class TypeQuery extends Connection
{
    public function getAll()
    {
        $sql = 'SELECT * FROM types ORDER BY title ASC';
        $data = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function insert($data): void
    {
        $sql = 'INSERT INTO types VALUES(null,:title)';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':title' => $data['title'],
        ]);
    }

    public function update($data): void
    {
        $sql = 'UPDATE types SET title = :title WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $data['id'],
            ':title' => $data['title']
        ]);
    }

    public function delete($id): void
    {
        $sql = 'DELETE FROM types WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $id
        ]);
    }
}
