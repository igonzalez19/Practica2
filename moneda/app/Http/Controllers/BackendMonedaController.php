<?php

namespace App\Http\Controllers;
use App\Models\Moneda;
use Illuminate\Http\Request;

class BackendMonedaController extends Controller
{
    
     public function index()
    {
        $array= [
            'openMoneda' => 'menu-open',
            'viewOpenMoneda' => 'active'
            ];
        
        $monedas = Moneda::all();
        return view('backend.moneda.index', $array,  ['monedas' => $monedas]);
    }
    
    
      public function show($moneda)
    {
        $moneda = Moneda::find($moneda);
        return view('backend.moneda.show', ['moneda' => $moneda]);
    }


    public function edit($moneda)
    {
        $moneda = Moneda::find($moneda);
        return view('backend.moneda.edit', ['moneda' => $moneda]);
    }    
    
    public function update(Request $request, Moneda $moneda)
    {
        try{
            $result = $moneda->update($request->all());    
        }catch(\Exception $e){
            $result = 0;
        }
        

        if($result){
            $response = [
                        'op' => 'update',
                        'result' => $result,
                        'id' => $moneda->id,
                        'name' => $moneda->name,
                ];
            return redirect('backend/moneda')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }
    
      public function create()
    {
        return view('backend.moneda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          $moneda = new Moneda($request->all());
          try{
              $result = $moneda->save();
          }catch(\Exception $e){
              $result  = 0;
          }
        
        if($moneda->id > 0){

            $result = $moneda->save();
            $response = [
                'op' => 'create',
                'result' => $result,
                'id' => $moneda->id,
                'name' => $moneda->name,
                ];
            return redirect('backend/moneda')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }
    
    public function destroy(Moneda $moneda)
    {
        $id = $moneda->id;
        
        try{
            $result = $moneda->delete();    
        }catch(\Exception $e){
            $result = 0;
        }
        
        $response = [
            'op' => 'destroy',
            'result' => $result,
            'id' => $moneda->id,
            'name' => $moneda->name
            ];
        return redirect('backend/moneda')->with($response);
    }
    
}
