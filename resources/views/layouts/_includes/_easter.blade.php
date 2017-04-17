<style type="text/css">
canvas
{
    margin: 0px auto;
}
.easter-container
{
    margin: 0px;
    padding: 0px;
    text-align: center;
    width: 740px;
    margin: 0px auto;
    display: none;
}
</style>
<div class="easter-container">
    <h1 class="text-center">Bem vindo ao <strong>Pong<span class="text-warning">+</span></strong></h1>
    <canvas id="pong" width="600" height="500">
        This browser can not run this game (canvas support missing).
    </canvas>
</div>

<script type="text/javascript" src="/pong/lib/Game.js"></script>
<script type="text/javascript" src="/pong/lib/Background.js"></script>
<script type="text/javascript" src="/pong/lib/Paddle.js"></script>
<script type="text/javascript" src="/pong/lib/Player.js"></script>
<script type="text/javascript" src="/pong/lib/Opponent.js"></script>
<script type="text/javascript" src="/pong/lib/Ball.js"></script>

<script type="text/javascript">
    var game = new Game("pong");
    function startGame()
    {
        var form = document.getElementById("settings");
        game.number_of_players = 1;
        game.difficulty = 5;
        game.start();
    }
</script>
