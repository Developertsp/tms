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
    $user = auth('sanctum')->user();
    $user_roles =  $user->roles->pluck('name', 'name')->all();
    $system_roles = ['software_manager' => 'software_manager'];
    return ($user_roles  == $system_roles) ? true : false;
}

function user_company_id()
{
    $company_id = auth('sanctum')->user()->company_id;
    return $company_id;
}


function filter_company_id($name)
{
    $transformedName = preg_replace('/^[^#]*#/', '', $name);
    return ucfirst($transformedName);
}



function format_date($datetime)
{
    $formats = [
        'Y-m-d\TH:i:s.u\Z',
        'Y-m-d\TH:i:s\Z',
        'Y-m-d H:i:s',
        'Y-m-d',
    ];

    foreach ($formats as $format) {
        $date = DateTime::createFromFormat($format, $datetime);
        if ($date instanceof DateTime) {
            return $date->format('d/m/Y');
        }
    }

    return 'Invalid datetime';
}
function format_date_with_time($datetime)
{
    $formats = [
        'Y-m-d\TH:i:s.u\Z',
        'Y-m-d\TH:i:s\Z',
        'Y-m-d H:i:s',
        'Y-m-d',
    ];

    foreach ($formats as $format) {
        $date = DateTime::createFromFormat($format, $datetime);
        if ($date instanceof DateTime) {
            return $date->format('d/m/Y H:i:s');
        }
    }

    return 'Invalid datetime';
}

