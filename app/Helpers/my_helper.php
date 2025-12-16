<?php

function parse_rupiah($val)
{
    return (int) str_replace(['Rp', '.', ',', ' '], '', $val);
}
