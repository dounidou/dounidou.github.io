<?php

namespace App\Notifications;

use App\Models\invoices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Add_invoice_new extends Notification
{
    use Queueable;
    private $invoices;

  
    public function __construct(invoices $invoices)
    {
        $this->invoices = $invoices;
    }

    
    public function via($notifiable)
    { 
        // return ['mail','database'];
        return ['database'];
        
    }

    
    // public function toMail($notifiable)
    // {
        
    //  $url = 'http://127.0.0.1:8000/InvoicesDetails/'.$this->invoices;
        
    //     return (new MailMessage)                 
    //     ->subject('اضافة فاتورة جديدة')
    //     ->line('اضافة فاتورة جديدة')
    //     ->action('عرض الفاتورة', $url)
    //     ->line('شكرا لاستخدامك مورا سوفت لادارة الفواتير');
      
    // }

    
    public function toDatabase($notifiable)
    { //stocker de la bd dans att data id,title,user
        return [

            //'data' => $this->details['body']
            'id'=> $this->invoices->id,
            'title'=>'تم اضافة فاتورة جديد بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }
    
}
