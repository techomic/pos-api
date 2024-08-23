<?php

namespace Vikuraa\Modules\Grants;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\NoDataException;

class GrantModel extends Model
{
    public function byPersonId(int $personId)
    {
        $sql = "select * from grants where person_id = :pid";

        $data = $this->db->query($sql, [':pid' => $personId]);

        if (!is_array($data) || count($data) === 0) {
            throw new NoDataException('Employee not found');
        }

        $grants = new Grants;

        $grants->addAllFromDbArray($data);

        return $grants;
    }

}