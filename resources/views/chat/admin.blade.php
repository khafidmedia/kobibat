<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .wa-wrapper {
      height: 100vh;
      display: flex;
      flex-direction: row;
      background: #f0f2f5;
    }

    .sidebar {
      width: 300px;
      background-color: #fff;
      border-right: 1px solid #ddd;
      padding: 15px;
    }

    .chat-area {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .chat-header {
      padding: 15px;
      background-color: #008069;
      color: #fff;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .chat-box {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      background-color: #efeae2;
    }

    .message-bubble {
      max-width: 75%;
      padding: 12px 18px;
      margin-bottom: 12px;
      border-radius: 12px;
      word-wrap: break-word;
      position: relative;
      font-size: 15px;
    }

    .admin-msg {
      background-color: #d9fdd3;
      margin-left: auto;
      border-bottom-right-radius: 0;
    }

    .user-msg {
      background-color: #fff;
      margin-right: auto;
      border-bottom-left-radius: 0;
    }

    .chat-input {
      padding: 10px 15px;
      background-color: #f0f2f5;
      border-top: 1px solid #ddd;
    }

    .chat-input form {
      display: flex;
      gap: 10px;
    }

    .chat-input input {
      flex: 1;
    }

    .chat-list {
      max-height: 80vh;
      overflow-y: auto;
    }

    .chat-item {
      padding: 10px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
    }

    .chat-item:hover {
      background-color: #f7f7f7;
    }
  </style>
</head>
<body>

<div class="wa-wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <h5>Chats</h5>
    <div class="chat-list">
      <div class="chat-item">
        <strong>Theron Trump</strong><br>
        <small>Last seen 10:30pm</small>
      </div>
    </div>
  </div>

  <!-- Chat Area -->
  <div class="chat-area">
    <div class="chat-header">
      <div>Theron Trump</div>
      <div><small>Online</small></div>
    </div>

    <div class="chat-box" id="chatBox"></div>

    <div class="chat-input">
      <form id="chatForm">
        @csrf
        <input type="text" name="message" id="messageInput" class="form-control" placeholder="Type a message" required>
        <button class="btn btn-success">Send</button>
      </form>
    </div>
  </div>
</div>

<script>
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
  }

  function loadMessages() {
    fetch('/messages')
      .then(res => res.json())
      .then(data => {
        const box = document.getElementById('chatBox');
        box.innerHTML = '';

        data.forEach(msg => {
          const bubble = document.createElement('div');
          bubble.classList.add('message-bubble');
          bubble.classList.add(msg.sender === 'admin' ? 'admin-msg' : 'user-msg');

          bubble.innerHTML = `
            <div><small><strong>${msg.sender}</strong></small></div>
            ${escapeHtml(msg.message)}
          `;

          box.appendChild(bubble);
        });

        box.scrollTop = box.scrollHeight;
      });
  }

  document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const message = document.getElementById('messageInput').value;

    fetch('/send-admin', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ message })
    })
    .then(() => {
      document.getElementById('messageInput').value = '';
      loadMessages();
    });
  });

  setInterval(loadMessages, 1500);
  loadMessages();
</script>

</body>
</html>
