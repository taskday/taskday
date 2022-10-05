<?php

namespace Taskday\Plugin\Support;

enum Operator: string
{
    case IS_EQUAL = '=';
    case IS_NOT_EQUAL = '<>';
    case IS_GREATER_THAN = '>';
    case IS_LESS_THAN = '<';
    case CONTAINS = 'in';
    case NOT_CONTAINS = 'notin';
    case PRESENT = 'present';
}
