<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class EventControllerAdmin extends Controller
{

   
    function searchEvent(Request $request)
    {
        $locale = app()->getLocale();
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('events')
         ->where('title_'.$locale, 'like', '%'.$query.'%')
         ->orWhere('short_desc_'.$locale, 'like', '%'.$query.'%')
         ->get();
         
      }
      else
      {
       $data = DB::table('events')
         ->orderBy('id', 'DESC')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
        <td class="text-success fw-bold" style="font-style: initial; white-space: nowrap;"> <td>'.$row->{'title_'.$locale}.'</td>
        <td class="text-primary" style="white-space: nowrap">'.\App\Http\Controllers\TimeFormatter::eventDateLocal($row->due_date).'</td>
        <td class=" d-xl-table-cell text-primary">'.\App\Http\Controllers\TimeFormatter::timeLocal($row->start_time) .'</td>
        <td class="text-primary">'.\App\Http\Controllers\TimeFormatter::timeLocal($row->end_time).'</td>
        <td class=" d-md-table-cell text-dark">'. $row->{'short_desc_'.$locale} .'</td>
        
        
         
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
