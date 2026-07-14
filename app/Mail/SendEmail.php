<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    public function build()
    {
        $userID = Auth::id();
        $userProfile = User::findOrFail($userID);
        $shoppingCart = ShoppingCart::where('idUser', $userID)->get();
        $idProducts = $shoppingCart->pluck('idProduct')->toArray();

        $items = Product::whereIn('id', $idProducts)->get();

        $cartData = [];
        foreach ($items as $item) {
            // Find the corresponding ShoppingCart record
            $cartRecord = $shoppingCart->firstWhere('idProduct', $item->id);

            // Get the quantity from the ShoppingCart record
            $qty = $cartRecord ? $cartRecord->qty : 0;
            // Build an array with product and quantity information
            $cartData[] = [
                'idProduct' => $item->id,
                'product' => $item,
                'qty' => $qty,
                'description' => $item->description,
                'price' => $item->price,
            ];
        }
        return $this->view('sendemail', ['userProfile' => $userProfile, 'cartData' => $cartData]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.sendemail',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
