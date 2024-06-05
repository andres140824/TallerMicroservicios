document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('taskForm');
    const tasksContainer = document.getElementById('tasks');
    const filterPriority = document.getElementById('filterPriority');
    const filterState = document.getElementById('filterState');

    let tasks = [];

    taskForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const newTask = {
            id: Date.now(),
            titulo: taskForm.titulo.value,
            descripcion: taskForm.descripcion.value,
            prioridad: taskForm.prioridad.value,
            responsable: taskForm.responsable.value,
            fechaEstimada: taskForm.fechaEstimada.value,
            estado: 'Pendiente'
        };
        tasks.push(newTask);
        renderTasks();
        taskForm.reset();
    });

    filterPriority.addEventListener('change', renderTasks);
    filterState.addEventListener('change', renderTasks);

    function renderTasks() {
        tasksContainer.innerHTML = '';

        const filteredTasks = tasks.filter(task => {
            return (filterPriority.value === '' || task.prioridad === filterPriority.value) &&
                   (filterState.value === '' || task.estado === filterState.value);
        });

        filteredTasks.forEach(task => {
            const taskElement = document.createElement('div');
            taskElement.classList.add('task', getTaskClass(task.estado));
            taskElement.innerHTML = `
                <div class="task-details">
                    <strong>${task.titulo}</strong>
                    <p>${task.descripcion}</p>
                    <small>Responsable: ${task.responsable}</small>
                    <small>Prioridad: ${task.prioridad}</small>
                    <small>Fecha Estimada: ${task.fechaEstimada}</small>
                </div>
                <div class="task-actions">
                    <button class="edit" onclick="editTask(${task.id})">Editar</button>
                    <button class="delete" onclick="deleteTask(${task.id})">Eliminar</button>
                </div>
            `;
            tasksContainer.appendChild(taskElement);
        });
    }

    window.editTask = (id) => {
        const task = tasks.find(t => t.id === id);
        taskForm.titulo.value = task.titulo;
        taskForm.descripcion.value = task.descripcion;
        taskForm.prioridad.value = task.prioridad;
        taskForm.responsable.value = task.responsable;
        taskForm.fechaEstimada.value = task.fechaEstimada;
        tasks = tasks.filter(t => t.id !== id);
        renderTasks();
    };

    window.deleteTask = (id) => {
        tasks = tasks.filter(t => t.id !== id);
        renderTasks();
    };

    function getTaskClass(estado) {
        switch (estado) {
            case 'Pendiente': return 'pending';
            case 'En Proceso': return 'in-process';
            case 'Terminada': return 'completed';
            case 'En Impedimento': return 'blocked';
            default: return '';
        }
    }
});
