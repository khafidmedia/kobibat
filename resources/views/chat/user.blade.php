@extends('layouts.app')

@section('content')
    <div class="chat-wrapper">
        <div class="chat-header">
            Live Chat - User
        </div>

        <div class="chat-box" id="chatBox"></div>

        <form id="chatForm" class="chat-input">
            @csrf
            <input type="text" name="message" id="messageInput" class="form-control" placeholder="Ketik pesan..." required>
            <button class="btn btn-primary">Kirim</button>
        </form>
    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #eaeff1;
            font-family: 'Segoe UI', sans-serif;
        }

.chat-wrapper {
    height: 100vh;            /* penuh 1 layar */
    display: flex;
    flex-direction: column;
    border:1px solid #ccc;
    border-radius:8px;
    overflow:hidden;
}


        .chat-header {
            background-color: #0d6efd;
            color: #fff;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #f0f2f5;
        }

        .message-bubble {
            padding: 12px 18px;
            margin-bottom: 15px;
            border-radius: 16px;
            max-width: 75%;
            position: relative;
            word-wrap: break-word;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .user-msg {
            background-color: #dcf8c6;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }

        .admin-msg {
            background-color: #fff;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }

        .chat-input {
            display: flex;
            padding: 15px 20px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }

        .chat-input input {
            flex: 1;
            margin-right: 10px;
        }

        .action-buttons {
            margin-top: 5px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 2px 6px;
        }
    </style>

    <script>
        const userToken = '{{ session('user_token') }}';

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }

        function loadMessages() {
            fetch("{{ url('/messages') }}")
                .then(res => res.json())
                .then(data => {
                    const box = document.getElementById('chatBox');
                    box.innerHTML = '';

                    data.forEach(msg => {
                        const bubble = document.createElement('div');
                        bubble.classList.add('message-bubble');
                        bubble.classList.add(msg.sender === 'user' ? 'user-msg' : 'admin-msg');

                        const escapedMessage = escapeHtml(msg.message);

                        bubble.innerHTML = `
            <div><small><strong>${msg.sender}</strong></small></div>
            <span class="msg-text" data-id="${msg.id}">${escapedMessage}</span>
            ${msg.sender === 'user' && msg.user_token === userToken ? `
                  <div class="action-buttons">
                    <button onclick="editMsg(${msg.id}, '${escapedMessage.replace(/'/g, "\\'")}')" class="btn btn-sm btn-outline-primary">Edit</button>
                    <button onclick="deleteMsg(${msg.id})" class="btn btn-sm btn-outline-danger">Hapus</button>
                  </div>
                ` : ''}
          `;
                        box.appendChild(bubble);
                    });

                    box.scrollTop = box.scrollHeight;

                });
        }

        function editMsg(id, oldMessage) {
            const newMessage = prompt("Edit pesan:", oldMessage);
            if (newMessage && newMessage.trim() !== '') {
                fetch('/message/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="csrf-token"]').value
                    },
                    body: JSON.stringify({
                        id,
                        message: newMessage
                    })
                }).then(() => loadMessages());
            }
        }

        function deleteMsg(id) {
            if (confirm("Yakin ingin menghapus pesan?")) {
                fetch('/message/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="csrf-token"]').value
                    },
                    body: JSON.stringify({
                        id
                    })
                }).then(() => loadMessages());
            }
        }

        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const message = document.getElementById('messageInput').value;

            fetch("{{ route('chat.send.user') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        message
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        document.getElementById('messageInput').value = '';
                        loadMessages();
                    }
                });
        });

        setInterval(loadMessages, 1500);
        loadMessages();
    </script>
@endsection
