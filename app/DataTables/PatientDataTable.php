<?php

namespace App\DataTables;

use App\Models\Patient;
use App\Models\Patients;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientDataTable extends DataTable
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
            ->addColumn('action', 'patient.action')
            ->editColumn('profile_photo', function (Patients $patient){
                $url = $patient->profile_photo ? asset('upload_file/patient/'.$patient->profile_photo) : asset('upload_file/default.png');
                return "<img src='{$url}' width='70px' />";

            })
//            ->editColumn('status', function (Patients $patient) {
//                $status = ucfirst($patient->status);
//                $class = $status === 'Active' ? 'success' : 'secondary';
//                return "<a type='button' class='btn btn-{$class} btn-sm' href='javascript:;' onclick='StatusChange(\"".route('change_status_popup')."\", \"".route('change_status', $patient->id)."\", \"".'Are You Sure to change Status...?'."\", \"".'Patients'."\")'>$status</a>";
//
//            })
            ->editColumn('action', function (Patients $patient){
                return "<a type='button' class='btn btn-success btn-sm' href='".route('patient.patient_details', $patient->id)."'><i class='fa fa-plus'> </i> Add Report</a>
                        <a type='button' class='btn btn-primary btn-sm' href='".route('patient.patient_details', $patient->id)."'><i class='fa fa-user'> </i> View Profile</a>";
            })
            ->rawColumns(['profile_photo', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patients $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patients $model)
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
            ->orderBy(0)
            ->setTableId('patient-table')
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
//            'action',
//        ];

        return [
            Column::make('id'),
            Column::make('patient_id'),
            Column::make('profile_photo'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile_no'),
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
        return 'Patient_' . date('YmdHis');
    }
}
