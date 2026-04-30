<?php

namespace App\Mail;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaVendedorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Venta $venta) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu venta ha sido validada - MiniEcommerce',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.venta-validada-vendedor',
        );
    }
}
