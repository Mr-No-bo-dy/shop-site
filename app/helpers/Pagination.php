<?php
   namespace app\helpers;

   class Pagination
   {
      private $perPage;
      private $totalItems;
      private $numLinks;
      
      public function __construct(int $perPage, int $totalItems, int $numLinks = 6)
      {
         $this->perPage = $perPage;
         $this->totalItems = $totalItems;
         $this->numLinks = $numLinks;
      }

      public function getTotalPages()
      {
         return ceil($this->totalItems / $this->perPage);
      }
      
      public function getItemsPerPage(int $pageNum, array $items)
      {
         $startIndex = ($pageNum - 1) * $this->perPage;

         return array_slice($items, $startIndex, $this->perPage);
      }

      public function getLinks(int $currentPage)
      {
         $totalPages = $this->getTotalPages();

         $startLink = max(1, $currentPage - ($this->numLinks / 2));
         $endLink = min($startLink + $this->numLinks, $totalPages) + 1;
         if (($currentPage + ($this->numLinks / 2)) >= $totalPages) {
            $startLink = $endLink - $this->numLinks - 1;
         }

         $links = [];
         if ($startLink > 1) {
            $links[] = [
               'page' => 1,
               'label' => '<<',
            ];
         }
         if ($currentPage > 1) {
            $links[] = [
               'page' => $currentPage - 1,
               'label' => '<',
            ];
         }
         for ($i = $startLink; $i < $endLink; $i++) {
            $links[] =  [
               'page' => $i,
               'label' => $i,
               'active' => ($i == $currentPage),   // Потрібне НЕточне порівняння
            ];
         }
         if ($currentPage < $totalPages) {
            $links[] = [
               'page' => $currentPage + 1,
               'label' => '>',
            ];
         }
         if ($endLink < $totalPages + 1) {      // Не зовсім розумію, чому тут потрібен "+1"
            $links[] = [
               'page' => $totalPages,
               'label' => '>>',
            ];
         }

         return $links;
      }
   }
?>