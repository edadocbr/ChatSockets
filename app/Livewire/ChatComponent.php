<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

/**
 * Componente ChatComponent
 * 
 * Controlador Livewire para el sistema de chat en tiempo real.
 * Maneja el envío/recepción de mensajes y la selección de contactos.
 */
#[Layout('chat.layout')]
class ChatComponent extends Component
{
    /**
     * ID del usuario con quien se está chateando.
     * @var int|null
     */
    public ?int $selectedUserId = null;

    /**
     * Contenido del mensaje que se está escribiendo.
     * @var string
     */
    public string $messageContent = '';

    /**
     * Lista de contactos del usuario actual.
     * @var \Illuminate\Support\Collection
     */
    public $contacts;

    /**
     * Lista de mensajes de la conversación actual.
     * @var \Illuminate\Support\Collection
     */
    public $messages = [];

    /**
     * Inicializar el componente.
     */
    public function mount(): void
    {
        $userId = Auth::id();
        $this->contacts = User::where('id', '!=', $userId)->get();
    }

    /**
     * Seleccionar un contacto para chatear.
     * 
     * @param int $userId ID del contacto seleccionado
     */
    public function selectContact(int $userId): void
    {
        $this->selectedUserId = $userId;
        $this->loadMessages();
    }

    /**
     * Cargar los mensajes de la conversación actual.
     */
    public function loadMessages(): void
    {
        if (!$this->selectedUserId) {
            $this->messages = [];
            return;
        }

        $userId = Auth::id();

        $this->messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $this->selectedUserId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $this->selectedUserId)
                  ->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();
    }

    /**
     * Enviar un mensaje al contacto seleccionado.
     */
    public function sendMessage(): void
    {
        if (empty(trim($this->messageContent)) || !$this->selectedUserId) {
            return;
        }

        $userId = Auth::id();

        $message = Message::create([
            'sender_id' => $userId,
            'receiver_id' => $this->selectedUserId,
            'content' => trim($this->messageContent),
        ]);

        broadcast(new MessageSent($message));

        $this->messageContent = '';
        $this->loadMessages();
    }

    /**
     * Escucha el evento messageReceived disparado por Laravel Echo.
     * Recarga los mensajes cuando llega un mensaje nuevo por WebSockets
     */
    #[On('messageReceived')]
    public function onMessageReceived(): void
    {
        $this->loadMessages();
    }

    /**
     * Renderizar la vista del componente.
     * Usa la plantilla existente chat.dashboard
     */
    public function render()
    {
        return view('chat.dashboard');
    }
}
