{{-- Layout manejado por Livewire #[Layout('chat.layout')] --}}

<div>
        <div class="chat d-flex phoenix-offcanvas-container pt-1 mt-n1 mb-9">
          {{-- Nodos fantasmas para neutralizar null-pointers de phoenix.js chatInit --}}
          <div id="chat-content" style="display: none;"></div>
          <div class="chat-content" style="display: none;"></div>
          <div class="card-body d-none" id="chat-body-fallback"></div>
          <div class="chat-content-body-0 d-none" id="chat-scroll-fallback"></div>
          <div data-chat-thread-tab class="d-none" id="chat-tab-fallback"></div>

          <div class="card p-3 p-xl-1 mt-xl-n1 chat-sidebar me-3 phoenix-offcanvas phoenix-offcanvas-start" id="chat-sidebar"><button class="btn d-none d-sm-block d-xl-none mb-2" data-bs-toggle="modal" data-bs-target="#chatSearchBoxModal"><span class="fa-solid fa-magnifying-glass text-body-tertiary text-opacity-85 fs-7"></span></button>

            <div class="form-icon-container mb-4 d-sm-none d-xl-block"><input class="form-control form-icon-input" type="text" placeholder="People, Groups and Messages" /><span class="fas fa-user text-body fs-9 form-icon"></span></div>

            <div class="scrollbar">
              <div class="tab-content" id="contactListTabContent">
                <div data-chat-thread-tab-content="data-chat-thread-tab-content">
                  <ul class="nav chat-thread-tab flex-column list">
                    {{-- Lista de contactos dinámicos --}}
                    @foreach($contacts as $contact)
                    <li class="nav-item {{ $selectedUserId === $contact->id ? 'read active' : 'read' }}" role="presentation">
                      <a class="nav-link d-flex align-items-center justify-content-center p-2 {{ $selectedUserId === $contact->id ? 'active' : '' }}" 
                         data-bs-toggle="tab" 
                         data-chat-thread="data-chat-thread" 
                         href="#tab-thread-{{ $contact->id }}" 
                         role="tab" 
                         aria-selected="{{ $selectedUserId === $contact->id ? 'true' : 'false' }}"
                         wire:click="selectContact({{ $contact->id }})">
                        <div class="avatar avatar-xl position-relative me-2 me-sm-0 me-xl-2">
                          <img class="rounded-circle border border-2 border-light-subtle" src="/phoenixadmin/assets/img/team/avatar.webp" alt="" />
                        </div>
                        <div class="flex-1 d-sm-none d-xl-block">
                          <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-body fw-normal name text-nowrap">{{ $contact->name }}</h5>
                          </div>
                          <div class="d-flex justify-content-between">
                            <p class="fs-9 mb-0 line-clamp-1 text-body-tertiary text-opacity-85 message">Último mensaje...</p>
                          </div>
                        </div>
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card tab-content flex-1 phoenix-offcanvas-container">
            @if($selectedUserId)
            {{-- Sección de mensajes --}}
            <div class="tab-pane h-100 fade active show" id="tab-thread-{{ $selectedUserId }}" role="tabpanel" aria-labelledby="tab-thread-{{ $selectedUserId }}">
              <div class="d-flex flex-column h-100">
                <div class="card-header p-3 p-md-4 d-flex flex-between-center">
                  <div class="d-flex align-items-center"><button class="btn ps-0 pe-2 text-body-tertiary d-sm-none" data-phoenix-toggle="offcanvas" data-phoenix-target="#chat-sidebar"><span class="fa-solid fa-chevron-left"></span></button>
                    <div class="d-flex flex-column flex-md-row align-items-md-center">
                      <button class="btn fs-7 fw-semibold text-body-emphasis d-flex align-items-center p-0 me-3 text-start" data-phoenix-toggle="offcanvas" data-phoenix-target="#thread-details-0">
                        <span class="line-clamp-1">{{ $contacts->firstWhere('id', $selectedUserId)->name ?? 'Usuario' }}</span>
                        <span class="fa-solid fa-chevron-down ms-2 fs-10"></span>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3 p-sm-4 scrollbar chat-content-body-0">
                  {{-- Mensajes dinámicos --}}
                  @forelse($messages as $msg)
                    @if($msg->sender_id === Auth::id())
                    {{-- Mensaje enviado (derecha) --}}
                    <div class="d-flex chat-message">
                      <div class="d-flex mb-2 justify-content-end flex-1">
                        <div class="w-100 w-xxl-75">
                          <div class="d-flex flex-end-center">
                            <div class="chat-message-content me-2">
                              <div class="mb-1 sent-message-content bg-primary rounded-2 p-3 text-white" data-bs-theme="light">
                                <p class="mb-0">{{ $msg->content }}</p>
                              </div>
                            </div>
                          </div>
                          <div class="text-end">
                            <p class="mb-0 fs-10 text-body-tertiary text-opacity-85 fw-semibold">{{ $msg->created_at->format('M d, Y') }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    @else
                    {{-- Mensaje recibido (izquierda) --}}
                    <div class="d-flex chat-message">
                      <div class="d-flex mb-2 flex-1">
                        <div class="w-100 w-xxl-75">
                          <div class="d-flex">
                            <div class="avatar avatar-m me-3 flex-shrink-0"><img class="rounded-circle" src="/phoenixadmin/assets/img/team/avatar.webp" alt="" /></div>
                            <div class="chat-message-content received me-2">
                              <div class="mb-1 received-message-content border rounded-2 p-3">
                                <p class="mb-0">{{ $msg->content }}</p>
                              </div>
                            </div>
                          </div>
                          <p class="mb-0 fs-10 text-body-tertiary text-opacity-85 fw-semibold ms-7">{{ $msg->created_at->format('M d, Y') }}</p>
                        </div>
                      </div>
                    </div>
                    @endif
                  @empty
                    <div class="d-flex justify-content-center align-items-center h-100">
                      <p class="text-body-tertiary">No hay mensajes aún. ¡Envía el primero!</p>
                    </div>
                  @endforelse
                </div>
                {{-- Footer con textarea de envío --}}
                <div class="card-footer">
                  <div class="d-flex align-items-end gap-2">
                    <div class="flex-1">
                      <textarea 
                        wire:model="messageContent" 
                        class="form-control"
                        placeholder="Escribe tu mensaje..."
                        rows="1"
                        style="resize: none;"
                      ></textarea>
                    </div>
                    <div>
                      <button 
                        wire:click="sendMessage" 
                        class="btn btn-primary fs-10"
                        wire:prop:disabled="!$messageContent.trim();"
                      >
                        Enviar<span class="fa-solid fa-paper-plane ms-1"></span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @else
            {{-- Mensaje cuando no hay contacto seleccionado --}}
            <div class="tab-pane h-100 fade active show" role="tabpanel">
              <div class="d-flex flex-column h-100 justify-content-center align-items-center">
                <div class="text-center">
                  <span class="fa-solid fa-comments fs-1 text-body-tertiary mb-3"></span>
                  <h4 class="text-body-tertiary">Selecciona un contacto para comenzar</h4>
                  <p class="text-body-tertiary text-opacity-75">Elige alguien de la lista de contactos</p>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>

{{-- Script de Laravel Echo para recibir mensajes en tiempo real --}}
<script>
    document.addEventListener('livewire:init', () => {
        const userId = {{ auth()->id() }};

        if (!window.Echo) return;

        window.Echo.private('chat.' + userId)
            .listen('MessageSent', (e) => {
                Livewire.dispatch('messageReceived', { message: e });
            });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('messageReceived', () => {
            setTimeout(() => {
                const chatDiv = document.getElementById('chat-content') || document.querySelector('.chat-content');
                if (chatDiv && chatDiv.style.display !== 'none') {
                    chatDiv.scrollTop = chatDiv.scrollHeight;
                }
            }, 100);
        });
    });
</script>
</div>
