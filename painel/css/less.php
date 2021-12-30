

<link rel="stylesheet" href="../assets/editor-less/codemirror.css">
<link rel="stylesheet" href="../assets/editor-less/themes/icecoder.css">
<script src="../assets/editor-less/codemirror.js"></script>
<script src="../assets/editor-less/javascript.js"></script>
<script src="../assets/editor-less/active-line.js"></script>
<script src="../assets/editor-less/matchbrackets.js"></script>
<script src="../assets/editor-less/css.js"></script>
<style>.CodeMirror {border: 1px solid #ddd; line-height: 1.2;}</style>

<article>
<h2>Editor LESS/CSS</h2>
<form>
<textarea id="code" name="code"><!-- CSS / LESS -->


</textarea>
</form>

<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
  mode: "text/x-less"
});
</script>
</article>

