<table class="tableAnswer">
    <tr><td>
            <h3>Search</h3>
            <form  method="post" action="/public/question/search/">
                <input  type="text" name="name">
                <select name="where">
                    <option value="theme" selected>In questions</option>
                    <option value="answer">In answers</option>
                </select>
                <input  type="submit" name="submit" value="Search">
            </form>
    </td></tr>
</table>