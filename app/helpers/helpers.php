<?php
function table_date($datetime)
{
    $date = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $datetime);
    if ($date instanceof DateTime) {
        return $date->format('M d, Y');
    } else {
        return 'Invalid datetime';
    }
}

function end_url()
{
    return url('/api') . '/';
}

function system_role()
{
    $user = Auth()->user();
    $user_roles =  $user->roles->pluck('name', 'name')->all();
    $system_roles = ['software_manager' => 'software_manager'];
    return ($user_roles  == $system_roles) ? true : false;
}

function user_company_id()
{
    $company_id = Auth()->user()->company_id;
    return $company_id;
}

function filter_company_id($name)
{
    $transformedName = preg_replace('/^[^#]*#/', '', $name);
    return ucfirst($transformedName);
}
