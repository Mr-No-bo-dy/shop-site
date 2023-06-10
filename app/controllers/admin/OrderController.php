<?php 
   use app\vendor\Controller;
   use app\models\Order;
   use app\models\Status;
   use app\models\User;
   use app\models\Customer;
   use app\helpers\Pagination;

   class OrderController extends Controller
   {

      // Control which method would be used
      public function actionCheck()
      {
         if (!is_null($this->getPost('idOrderUpdate'))) {
            $this->actionUpdate();
         } else {
            $this->actionIndex();
         }
      }

      // Show all Orders
      public function actionIndex()
      {
         $orderModel = new Order();
         $statusModel = new Status();
         $userModel = new User();
         $customerModel = new Customer();
         
         // Формування фільтрів
         $filters = [
            'productName' => '',
            'id_status' => 0,
            'id_customer' => 0,
            'id_user' => 0,
         ];
         $productName = $this->getPost('productName');
         if (!empty($productName)) {
            $filters['productName'] = $productName;
         }
         $idStatus = $this->getPost('id_status');
         if (!empty($idStatus)) {
            $filters['id_status'] = $idStatus;
         }
         $idCustomer = $this->getPost('id_customer');
         if (!empty($idCustomer)) {
            $filters['id_customer'] = $idCustomer;
         }
         $idUser = $this->getPost('id_user');
         if (!empty($idUser)) {
            $filters['id_user'] = $idUser;
         }
         $resetFilters = $this->getPost('resetFilters');
         if (!empty($resetFilters)) {
            unset($_SESSION['filters']);
         }
         if (!empty($filters['productName']) || !empty($filters['id_status']) || !empty($filters['id_customer']) || !empty($filters['id_user'])) {
            $this->setSession('filters', $filters);
         }
         if (!empty($_SESSION['filters'])) {
            $filters = array_merge($filters, $this->getSession('filters'));
         }

         // Витягування з БД даних і формування контенту на в'юшку
         $allOrders = $orderModel->getAllOrders($filters);
         $allStatuses = $statusModel->getAll(['category' => ['order']]);
         $users = $statusModel->getAll(['category' => ['user']]);
         $idsUser = [];
         foreach ($users as $idUser => $user) {
            $idsUser[] = $idUser;
         }
         $allUsers = $userModel->getAll(['id_status' => $idsUser]);
         $customers = $statusModel->getAll(['category' => ['customer']]);
         $idsCustomer = [];
         foreach ($customers as $idCustomer => $customer) {
            $idsCustomer[] = $idCustomer;
         }
         $allCustomers = $customerModel->getAll(['id_status' => $idsCustomer]);

         // Pagination:
         $pagination = new Pagination(5 , count($allOrders));
         $page = $this->getGet('page') ?? 1;
         $links = $pagination->getLinks($page);
         $totalPages = $pagination->getTotalPages();

         $content = [
            'allOrders' => $pagination->getItemsPerPage($page, $allOrders),
            'allStatuses' => $allStatuses,
            'allUsers' => $allUsers,
            'filterStatuses' => array_merge([0 => ['id_status' => 0, 'name' => 'All Statuses']], $allStatuses),
            'filterUsers' => array_merge([0 => ['id_user' => 0, 'first_name' => 'All', 'last_name' => 'Sellers']], $allUsers),
            'filterCustomers' => array_merge([0 => ['id_customer' => 0, 'first_name' => 'All', 'last_name' => 'Customers']], $allCustomers),
            'filters' => $filters,
            'totalPages' => $totalPages,
            'links' => $links,
         ];
            
         return $this->view('admin/order/index', $content);
      }

      // Update some Order
      public function actionUpdate()
      {
         $orderModel = new Order();
         
         if (!is_null($this->getPost('idOrderUpdate'))) {
            $postData = $this->getPost();
            $idOrder = $postData['idOrderUpdate'];
            $setOrderData = [
               'id_status' => $postData['idStatusUpdate'],
               'id_user' => $postData['idUserUpdate'],
            ];
            $orderModel->update($idOrder, $setOrderData);
         }

         return $this->actionIndex();
      }
   }
?>