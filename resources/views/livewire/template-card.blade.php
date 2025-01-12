@assets
<style>
    .a4-container{
        display: grid;
        place-items: center;
    }
    .a4{
        width: clamp(90px, 60vw, 210mm);
        aspect-ratio: 210 / 297;
        border: 1px solid #ccc;
        padding: 2em clamp(2em, 10vw, 4em);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        font-size: clamp(14px, 2vw, 16px);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border: 1px solid #f8f8f8;
    }
    tr {
        border-bottom: 1px solid #ddd;
    }
    tr:nth-child(even) {
        background-color: #ecf1f5;
    }
    td,
    th {
        padding: 6.35mm 0;
    }
</style>
@endassets 
<div class="a4-container">
    <div class="a4">
        @if($header)
        <header>
            <h1 class="logo">
                <img src="logo.png" alt="logo">
            </h1>
            <div class="header-data"></div>
        </header>
        @endif
        <main>
            <table>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>email</th>
                    <th>count</th>
                </tr>
            </table>
        </main>
        @if($footer)
        <footer>
            <h3></h3>
            <p></p>
        </footer>
        @endif
    </div>
</div>