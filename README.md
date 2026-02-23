# PHP Auth & Products API - Kubernetes Ready 🚀

Este proyecto es una API REST desarrollada en PHP puro que implementa autenticación mediante **JSON Web Tokens (JWT)**. Está diseñada siguiendo una arquitectura modular y preparada para ser desplegada en un clúster de **Kubernetes**.


## 🛠️ Tecnologías y Herramientas
* **Lenguaje:** PHP 8.x
* **Autenticación:** JWT (HS256)
* **Contenedor:** Docker (Imagen alojada en DockerHub)
* **Orquestación:** Kubernetes (Minikube)
* **Pruebas:** Thunder Client (VS Code)

---

## 📂 Estructura del Proyecto
* `public/index.php`: Punto de entrada único (Front Controller).
* `src/core/`: Motores del sistema (Router, Request, Response, JWT).
* `src/middleware/`: Capa de seguridad (AuthMiddleware).
* `src/controllers/`: Controladores de Auth y Productos.
* `src/data/`: Archivos JSON que actúan como base de datos.

---

## 🚀 Despliegue en Kubernetes

Para desplegar la aplicación en el entorno local de Kubernetes:

```bash
# Iniciar el clúster
minikube start

# Aplicar los manifiestos de Kubernetes
kubectl apply -f k8s/

# Obtener la URL del servicio para las pruebas
minikube service php-auth-service --url