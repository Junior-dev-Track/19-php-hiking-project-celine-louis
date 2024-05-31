function addTagField() {
    const container = document.getElementById('dynamicTagsContainer');

    const newDiv = document.createElement('div');
    newDiv.className = "input-group mb-3";
    container.appendChild(newDiv);

    const newSpan = document.createElement('span');
    newSpan.className = "input-group-text";
    newSpan.textContent = '🔖';
    newDiv.appendChild(newSpan);


    const newTagField = document.createElement('input');
    newTagField.type = 'text';
    newTagField.className = 'form-control';
    newTagField.id = "floatingInputGroup5";
    newTagField.name = 'tags[]';
    newTagField.placeholder = 'New category';

    newDiv.appendChild(newTagField);
}