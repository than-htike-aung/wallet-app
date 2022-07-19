<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
           'trs_id' => $this->trs_id,
           'ref_no' => $this->ref_no,
           'amount' => number_format($this->amount, 2). ' MMK',
           'type' => $this->type,
           'data_time' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'source' => $this->source ? $this->source->name : '-',
        
            'description' => $this->description];
    }
}
