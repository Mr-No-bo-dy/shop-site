<?php 
   class Controller
   {
      protected function render(string $template, array $data = [])
      {
         require_once 'app/resource/views/' . $template . '.php';
      }
   }