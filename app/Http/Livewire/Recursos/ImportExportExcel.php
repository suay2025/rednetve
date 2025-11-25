<?php

namespace App\Http\Livewire\Recursos;

use Livewire\Component;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\User;

class ImportExportExcel extends Component
{

    public function importView(Request $request){
        return view('importFile');
    }
    public function import(Request $request){
        if($request->file('file'))
        {
            Excel::import(new ImportUser, $request->file('file')->store('files'));
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['msg' => 'No ha seleccionado el archivo!']);
        }
        
    }
    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function render()
    {
        return view('livewire.recursos.import-export-excel');
    }
}
