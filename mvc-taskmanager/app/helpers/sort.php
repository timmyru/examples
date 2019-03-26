<?php

function sortEmail($a, $b)
{
    return strcmp($a["email"], $b["email"]);
}

function sortUsername($a, $b)
{
    return strcmp($a["username"], $b["username"]);
}

function sortIsDone($a, $b)
{
    return strcmp($a["isDone"], $b["isDone"]);
}