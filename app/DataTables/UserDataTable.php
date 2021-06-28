<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'user.action')
            ->editColumn('profile_photo', function (User $user){
                $url = $user->profile_photo ? asset('upload_file/user/'.$user->profile_photo) : asset('upload_file/default.png');
                return "<img src='{$url}' width='100px' />";

            })
            ->editColumn('status', function (User $user) {
                $status = ucfirst($user->status);
                $class = $status === 'Active' ? 'success' : 'secondary';
                return "<a type='button' class='btn btn-{$class} btn-sm' href='javascript:;' onclick='StatusChange(\"".route('change_status_popup')."\", \"".route('change_status', $user->id)."\", \"".'Are You Sure to change Status...?'."\", \"".'user'."\")'>$status</a>";

            })
            ->editColumn('action', function (User $user){
                return "<a type='button' class='btn btn-primary btn-sm' href='".route('user.user_details', $user->id)."'><i class='fa fa-user'> </i> View Profile</a>";
            })
            ->rawColumns(['profile_photo', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->pageLength('5')
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
//        return [
//            'id',
//            'profile_photo',
//            'name',
//            'email',
//            'mobile_no',
//            'status',
//            'action',
//        ];

        return [
            Column::make('id'),
            Column::make('profile_photo'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile_no'),
            Column::computed('status')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
                ->addClass('text-center'),
            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
