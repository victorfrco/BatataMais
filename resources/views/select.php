<?php
/**
 * Created by PhpStorm.
 * User: victor.oliveira
 * Date: 23/11/2017
 * Time: 15:06
 */
dd($_POST);
 if(isset($_POST["data"]))
 {
     $output = '';

     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';

         $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">NOME</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">'.$_POST["employee_id"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%"></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Designation</label></td>  
                     <td width="70%"></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%">Year</td>  
                </tr>  
                ';

     $output .= "</table></div>";
     echo $output;
 }
