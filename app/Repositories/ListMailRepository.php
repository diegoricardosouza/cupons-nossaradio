<?php

namespace App\Repositories;

use App\Models\ListMail;

class ListMailRepository {
    protected $entity;

    public function __construct(ListMail $mail)
    {
        $this->entity = $mail;
    }

    public function getAll($number = 6)
    {
        return $this->entity->paginate($number);
    }

    public function getAllMails()
    {
        return $this->entity->all();
    }

    public function getMail($id)
    {
        return $this->entity->find($id);
    }

    public function getMailByName($email)
    {
        return $this->entity->where('email', $email)->first();
    }

    public function createNew($data)
    {
        return $this->entity->create($data);
    }

    public function update($id, $data)
    {
        $mail = $this->getMail($id);

        return $mail->update($data);
    }

    public function delete($id)
    {
        $mail = $this->getMail($id);

        return $mail->delete();
    }
}


