const API_URL = 'http://psmedical.com/admin/api/users.php'; // Replace with actual API URL

// Function to fetch all users
function getUsers() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayUsers(data);
    } else {
      document.getElementById('usersContainer').innerHTML = 'No users found.';
    }
  })
  .catch(error => console.error('Error fetching users:', error));
}

// Function to display users on the page
function displayUsers(users) {
  const usersContainer = document.getElementById('usersContainer');
  usersContainer.innerHTML = ''; // Clear previous user list

  users.forEach(user => {
    const userItem = document.createElement('div');
    userItem.classList.add('user-item');
    userItem.innerHTML = `
      <h3>${user.fullName}</h3>
      <p><strong>Username:</strong> ${user.username}</p>
      <p><strong>Status:</strong> ${user.status}</p>
      <button class="edit" onclick="editUser(${user.user_id})">Edit</button>
      <button onclick="deleteUser(${user.user_id})">Delete</button>
    `;
    usersContainer.appendChild(userItem);
  });
}

// Function to create a new user
function createUser(event) {
  event.preventDefault();

  const userData = {
    fullName: document.getElementById('fullName').value,
    username: document.getElementById('username').value,
    password: document.getElementById('password').value,
    status: document.getElementById('status').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'User created successfully') {
      alert('User created successfully');
      getUsers();  // Refresh the user list
    } else {
      alert('Error creating user: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating user:', error));
}

// Function to edit a user
function editUser(userId) {
  fetch(`${API_URL}?id=${userId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('User not found.');
    }
  })
  .catch(error => console.error('Error fetching user:', error));
}

// Function to populate the edit form
function populateEditForm(user) {
  document.getElementById('fullName').value = user.fullName;
  document.getElementById('username').value = user.username;
  document.getElementById('password').value = ''; // Password should be blanked out for security
  document.getElementById('status').value = user.status;

  const userForm = document.getElementById('userForm');
  userForm.querySelector('button').textContent = 'Update User'; // Change button text to 'Update'

  // Change form submission to update user
  userForm.onsubmit = function(event) {
    event.preventDefault();
    updateUser(user.user_id);
  };
}

// Function to update an existing user
function updateUser(userId) {
  const updatedData = {
    fullName: document.getElementById('fullName').value,
    username: document.getElementById('username').value,
    password: document.getElementById('password').value,
    status: document.getElementById('status').value,
  };

  fetch(`${API_URL}?id=${userId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'User updated successfully') {
      alert('User updated successfully');
      getUsers();  // Refresh the user list
      document.getElementById('userForm').querySelector('button').textContent = 'Create User'; // Reset button text
    } else {
      alert('Error updating user: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating user:', error));
}

// Function to delete a user
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    fetch(`${API_URL}?id=${userId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'User deleted successfully') {
        alert('User deleted successfully');
        getUsers();  // Refresh the user list
      } else {
        alert('Error deleting user: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting user:', error));
  }
}

// Fetch users on page load
window.onload = function() {
  getUsers();
  document.getElementById('userForm').addEventListener('submit', createUser);
};
