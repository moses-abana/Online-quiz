
<h2>Add exam</h2>
<form action="sub_new_exam.php" method="post">
    <div class="mb-3 mt-3">
        <label for="exname" class="form-label">Exam name</label>
        <input type="text" name="exam_name" id="exname" class="form-control" placeholder="Enter Exam name">
    </div>
    <div class="mb-3 ">
        <label for="exduration" class="form-label">Exam duration (mins)</label>
        <input type="number" name="exam_duration" id="exduration" class="form-control" placeholder="Enter Exam duration">
    </div>
    <div class="mb-3">
        <label for="exnquestion" class="form-label">Total number of question</label>
        <input type="number" name="exam_nquestion" id="exnquestion" class="form-control" placeholder="Enter Exam number of question">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
