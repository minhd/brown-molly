<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

    </head>
    <body>

        <ul>
            <li v-for="user in users" track-by="$index">@{{ user }}</li>
        </ul>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.6/socket.io.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.js"></script>

        <script>
            var socket = io('http://127.0.0.1:3000');
            new Vue({
                el: 'body',
                data: {
                    users: []
                },
                ready: function() {
                    var vm = this;
                    socket.on('test-channel:App\\Events\\UserSignedUp', function(data){
                        vm.users.push(data.username);
                    });
                }
            });
        </script>
    </body>
</html>
