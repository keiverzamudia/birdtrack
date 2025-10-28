<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="text-center mb-4">Add a Comment</h2>
    <div class="card shadow-sm p-4">
        <form id="commentForm" onsubmit="event.preventDefault(); sendComment(); ">
            <div class="mb-3">
                <label class="form-label">Enter Subject</label>
                <input type="text" class="form-control" id="subject" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Enter Comment</label>
                <textarea class="form-control" id="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Post Comment</button>
        </form>
    </div>
    <script>

        var ws = new WebSocket("ws://localhost:8080");

        function sendComment() {
            var subject = document.getElementById('subject').value;
            var comment = document.getElementById('comment').value;

            if (subject && comment) {
                var data = {
                    type: "new_comment",
                    subject: subject,
                    comment: comment
                };

                ws.send(JSON.stringify(data));

                document.getElementById("commentForm").reset();

                alert("Comment Added!");

            } else {
                alert("Both fields are required!");
            }
        }

    </script>
</div>  