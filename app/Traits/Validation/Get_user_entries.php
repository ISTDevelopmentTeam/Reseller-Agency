<?php

namespace App\Traits\Validation;
use App\Models\MembersApplication;

trait Get_user_entries
{   
    public function get_user_entries($data = [])
    {
        $query = MembersApplication::select(
            'members_firstname',
            'members_lastname',
            'application_date'
        );
    
        $query->whereDate('application_date', now()->toDateString());
        $query->where('members_firstname', $data['firstname']);
        $query->where('members_lastname', $data['lastname']);

        return $query->count();
        // $results = $query->get();
    
        // return $results;
    }

}
 