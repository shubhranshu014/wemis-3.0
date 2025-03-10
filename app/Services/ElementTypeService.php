<?php
namespace App\Services;

use Exception;
use App\Models\ElementType;

class ElementTypeService
{

    public function index(){
        $types = ElementType::with('elements')->get(['id','type','sim_count']);
        return $types;
    }
    public function store($request){
        try {
            $element = new ElementType();
            $element->element_id = $request["element"];
            $element->type = $request["type"];
            $element->save();
        
        } catch (Exception $e) {
            // Log the exception message, if logging is set up
            error_log($e->getMessage());
        
            // Provide a more informative error message
            throw new Exception('Error storing element type with the specified columns: ' . $e->getMessage(), 0, $e);
        }
    }
}