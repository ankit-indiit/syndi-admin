<?php

namespace App\DataTables;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;

class UsersDataTable extends DataTable
{   
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)->addIndexColumn()            

            ->editColumn('name', static function (User $user) {
                return $user->name;
            })

            ->editColumn('email', static function (User $user) {
                return $user->email;
            })  

            ->editColumn('role', static function (User $user) {
                foreach ($user->getRoleNames() as $role) {
                    return '<span class="badge badge-primary">'.$role.'</span>';
                }                                      
            })  

            ->editColumn('image', static function (User $user) {
                return '<img src="'.$user->image.'" style="height: 80px; width: 80px; border-radius: 50px;">';
            })

            ->editColumn('status', static function (User $user) {
                $status = $user->status == 1 ? 'checked' : '';
                return '<label class="switch"><input type="checkbox" name="profile_status" class="profileStatus" data-user="'.$user->id.'" '.$status.' ><span class="slider round"></span></label>';
            }) 

            ->editColumn('action', static function (User $user) {
                return '<a href="'.route('user.edit', $user->id).'" class="btn btn-sm bg-info-light"><i class="fa fa-edit"></i></a><a href="#" class="btn btn-sm bg-danger-light" id="deleteUser" data-id="'.$user->id.'"><i class="fa fa-trash"></i></a>';
            })                 
           
            ->setRowId(function ($user) {
                return 'users-'.$user->id;
            })
            ->rawColumns(['image', 'role', 'action','status']);
    }
   
    public function query(Request $request, User $user)
    {        
        return User::where('email', '!=', 'developerindiit@gmail.com')->newQuery();
    }
 
    public function html()
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass(['table-hover', 'table-bordered', 'table-md'])
            ->parameters([
                'lengthMenu' => [
                    [ 25, 50, 100, 500],
                    [ '25', '50', '100', '500']
                ],
                // 'dom' => 'Blfrtip',
            ])->orderBy(1);
    }
  
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false),
            Column::make('name')->searchable(true)->orderable(true),     
            Column::make('email')->searchable(true)->orderable(true),            
            Column::make('role')->searchable(false)->orderable(false),            
            Column::make('image')->orderable(false),           
            Column::make('status')->orderable(false),            
            Column::make('action')->searchable(false)->orderable(false),    
        ];
    }
}
