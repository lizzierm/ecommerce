<?php 
namespace App\Enums;

enum OrderStatus:int{
    case Pending = 1;
    case Processing = 2;
    case Shipped= 3;
    case Completed = 4;
    case Cancelled= 5; //cancelado
    case Failed= 6; //fallo
    case Refunded= 7; //reintegrado
    
}