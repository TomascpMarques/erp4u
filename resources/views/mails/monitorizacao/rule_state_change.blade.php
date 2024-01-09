<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");
    * {
        font-family: "Roboto", sans-serif;
    }
    body {
        margin: 0;
        padding: 0;
    }
    .main {
        display: flex;
        flex-direction: column;
        max-width: 70vw;
        margin: auto;
        height: 100%;
        position: relative;
    }
    h1,
    h2,
    h3 {
        margin: 0;
        padding: 0.2rem;
    }
    hr {
        border: none;
        border-radius: 999px;
        height: 0.12rem;
        background: gainsboro;
        width: 100%;
        margin: 1rem 0 1rem;
    }
    footer {
        width: 100%;
        margin: 0;
        padding: 0.6rem 0 0.6rem 0;
        font-size: 0.83rem;
        color: gray;
    }
    footer > p {
        position: relative;
        float: right;
        width: fit-content;
    }
    header {
        margin-top: 0.5rem;
        border-radius: 0.5rem;
        background: rgb(32, 99, 255);
        color: white;
        padding: 0.7rem 1rem;
    }
    p {
        height: 100%;
        margin: 0;
        padding: 0.1rem 1rem;
    }
</style>

<div class="main">
    <header>
        <h2>Olá!</h2>
        <h4>Tens uma nova notificação de monitorização.</h4>
    </header>
    <hr />
    <p>{{ $messageContent }}</p>
    <br />
    <footer>
        <p>Com ❤️ ERP4U - Students ERP (2024)</p>
    </footer>
</div>
