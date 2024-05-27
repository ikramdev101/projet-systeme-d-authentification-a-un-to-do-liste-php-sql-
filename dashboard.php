<?php
session_start(); // Démarrez la session au début de votre code PHP

if (isset($_POST['logout'])) {
    // Détruisez la session
    session_destroy();
    // Redirigez vers la page de connexion
    header("Location: login.php");
    exit(); // Assurez-vous de quitter le script après la redirection
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do-it - Hamza Mameri</title>
   <link rel="stylesheet" href="views/dashbordStyle.css">
</head>
<body>
    <div class="app-container">
        <aside>
            <div class="profile">
                <div class="profile-pic"></div>
                <?php
    // Récupérer le nom de l'utilisateur depuis l'URL
    $nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
    // Afficher le nom de l'utilisateur dans le titre h2
   
    ?>
                <h2><?php echo $nom ?></h2>
            </div>
            <nav>
                <ul>
                    <li><button class='taske'>Today tasks</button></li>
                    <li class="filter"><button>Personal</button></li>
                    <li class="filter"><button>Freelance</button></li>
                    <li class="filter"><button>Work</button></li>
                    <li class="filter"><button>Add filter</button></li>
                    <li><button>Scheduled tasks</button></li>
                    <li><button>Settings</button></li>
                    <li><button class='btn' onclick="logout()">Log out</button></li>

                </ul>
            </nav>
        </aside>
        <main>
            <header>
                <h1>Today main focus</h1>
                <h2>Design team meeting</h2>
            </header>
            <div class="task-form">
                <input type="text" id="new-task-name" placeholder="Task name">
                <input type="time" id="new-task-time" placeholder="Task time">
                <button onclick="addTask()">Add Task</button>
            </div>
            <section class="tasks" id="task-container">
                <div class="task">
                    <span>Work out</span>
                    <time>8:00 am</time>
                    <button onclick="deleteTask(this)">Supprimer</button>
                </div>
               
            </section>
        </main>
    </div>
    <script>
        function addTask() {
            const taskName = document.getElementById('new-task-name').value;
            const taskTime = document.getElementById('new-task-time').value;
            if (taskName.trim() === '' || taskTime.trim() === '') {
                alert('Please enter a task name and time');
                return;
            }

            const taskContainer = document.getElementById('task-container');
            const taskElement = document.createElement('div');
            taskElement.classList.add('task');
            taskElement.innerHTML = `<span>${taskName}</span><time>${taskTime}</time><button onclick="deleteTask(this)">Supprimer</button>`;
            taskContainer.appendChild(taskElement);

            document.getElementById('new-task-name').value = '';
            document.getElementById('new-task-time').value = '';
        }

        function deleteTask(button) {
            const taskElement = button.parentElement;
            taskElement.remove();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const tasks = [
                { name: 'Work out', time: '8:00 am' },
                { name: 'Design team meeting', time: '2:30 pm' },
                { name: 'Hand off the project', time: '7:00 pm' },
                { name: 'Read 5 pages of “sprint”', time: '10:30 pm' }
            ];

            const taskContainer = document.getElementById('task-container');

            tasks.forEach(task => {
                const taskElement = document.createElement('div');
                taskElement.classList.add('task');
                taskElement.innerHTML = `<span>${task.name}</span><time>${task.time}</time><button onclick="deleteTask(this)">Supprimer</button>`;
                taskContainer.appendChild(taskElement);
            });
        });
       
    function logout() {
        // Créez un formulaire caché
        const form = document.createElement('form');
        form.method = 'post';
        form.action = '';
        
        // Ajoutez un champ de formulaire pour indiquer la déconnexion
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'logout';
        input.value = 'true';
        
        // Ajoutez le champ de formulaire au formulaire
        form.appendChild(input);
        
        // Ajoutez le formulaire à la page et soumettez-le
        document.body.appendChild(form);
        form.submit();
    }

    </script>
</body>
</html>
