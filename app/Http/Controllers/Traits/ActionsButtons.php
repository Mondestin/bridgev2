<?php

namespace App\Http\Controllers\Traits;

trait ActionsButtons {

    public function actionTablesButtons(int $id, string $modelName): String
    {
      return '
                <a class="btn btn-success btn-sm" href="'.$modelName.'/'.$id.'"title="Profile"><i class="fa fa-eye m-r-5"></i></a>
                <a class="btn btn-warning btn-sm text-white" href="'.$modelName.'/'.$id.'/edit/" title="Modifier"><i class="fa fa-pencil m-r-5"></i> </a>
                <a class="btn btn-danger btn-sm delete" href="#" data-id='.$id.' title="Supprimer"><i class="fa fa-trash m-r-5"></i> </a>

            ';
    }
}
