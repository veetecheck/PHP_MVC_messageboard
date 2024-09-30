<?php

class Home extends Controller
{
 public function index() {
        $data = [
            'title' => 'Welcome to the Messageboard',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus quisquam illum nemo temporibus, inventore dicta officiis eos suscipit nostrum sunt id nisi cupiditate. Magnam dolorum saepe quisquam ipsum, reiciendis placeat facere, numquam, labore quae consectetur minus officia fuga obcaecati doloribus rem mollitia dolorem exercitationem deleniti sint. Vel, sequi dolore? Dicta eaque sed distinctio, rerum dignissimos maxime quam voluptas maiores assumenda.'
        ];
        
        $this->view('home', $data);
    }
}
