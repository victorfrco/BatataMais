<?php

namespace App\Http\Controllers;

use App\DeskHistory;
use Illuminate\Http\Request;

class DeskHistoryController extends Controller
{
    private $STATUS_VINCULANDO = 1;
    private $STATUS_DESVINCULANDO = 3;
    private $STATUS_PAGAMENTO = 2;

    /**
     * @return mixed
     */
    public function getSTATUSVINCULANDO()
    {
        return $this->STATUS_VINCULANDO;
    }

    /**
     * @return mixed
     */
    public function getSTATUSDESVINCULANDO()
    {
        return $this->STATUS_DESVINCULANDO;
    }

    /**
     * @return mixed
     */
    public function getSTATUSPAGAMENTO()
    {
        return $this->STATUS_PAGAMENTO;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeskHistory  $deskHistory
     * @return \Illuminate\Http\Response
     */
    public function show(DeskHistory $deskHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeskHistory  $deskHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(DeskHistory $deskHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeskHistory  $deskHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeskHistory $deskHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeskHistory  $deskHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskHistory $deskHistory)
    {
        //
    }
}
