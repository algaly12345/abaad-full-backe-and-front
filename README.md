# Abaad App — Docker + Kubernetes Setup

## هيكل الملفات

```
├── Dockerfile
├── .dockerignore
├── docker-compose.yml          ← للتطوير المحلي فقط
├── docker/
│   ├── nginx.conf
│   ├── php.ini
│   └── supervisord.conf
├── k8s/
│   ├── 00-namespace.yaml
│   ├── 01-secret.yaml          ← أضفه لـ .gitignore !
│   ├── 02-deployment.yaml
│   ├── 03-pvc.yaml
│   ├── 04-service.yaml
│   ├── 05-ingress.yaml
│   └── 06-migrate-job.yaml
└── .github/
    └── workflows/
        └── deploy.yml
```

---

## 1. تشغيل لوكل (Development)

```bash
# أولاً: غيّر APP_KEY في docker-compose.yml
# شغّل هذا لتوليد key جديد
docker run --rm php:8.2-alpine php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"

# شغّل كل شيء
docker compose up --build

# في terminal ثاني — شغّل الـ migrations
docker compose exec app php artisan migrate --force

# افتح: http://localhost:8080
```

---

## 2. رفع الـ Image على Docker Hub

```bash
docker login
docker build -t YOURUSERNAME/abaad-app:v1.0 .
docker push YOURUSERNAME/abaad-app:v1.0
```

---

## 3. إعداد الـ Cluster (على السيرفرين)

### السيرفر السعودي — Master
```bash
curl -sfL https://get.k3s.io | sh -
sudo cat /var/lib/rancher/k3s/server/node-token   # احفظ هذا
```

### السيرفر الخارجي — Worker
```bash
curl -sfL https://get.k3s.io | \
  K3S_URL=https://MASTER_IP:6443 \
  K3S_TOKEN=TOKEN_FROM_ABOVE sh -
```

### تحقق من الـ nodes
```bash
sudo kubectl get nodes
# يجب أن يظهر كلا السيرفرين Ready
```

---

## 4. النشر على الـ Cluster

```bash
# 1. عدّل k8s/01-secret.yaml بقيمك الحقيقية
# 2. عدّل k8s/02-deployment.yaml — غيّر اسم الـ image
# 3. عدّل k8s/05-ingress.yaml — غيّر الدومين

# طبّق كل شيء
sudo kubectl apply -f k8s/

# تابع الحالة
sudo kubectl get pods -n abaad -w

# شغّل الـ migrations
sudo kubectl apply -f k8s/06-migrate-job.yaml
sudo kubectl wait --for=condition=complete job/laravel-migrate -n abaad
```

---

## 5. إعداد CI/CD (GitHub Actions)

أضف هذه الـ Secrets في GitHub → Settings → Secrets:

| Secret | القيمة |
|--------|--------|
| `DOCKER_USERNAME` | اسم مستخدم Docker Hub |
| `DOCKER_PASSWORD` | كلمة مرور Docker Hub |
| `KUBECONFIG` | محتوى `/etc/rancher/k3s/k3s.yaml` من السيرفر |

```bash
# احصل على الـ kubeconfig من السيرفر السعودي
sudo cat /etc/rancher/k3s/k3s.yaml
# غيّر 127.0.0.1 بـ IP السيرفر السعودي الحقيقي
```

---

## أوامر مفيدة

```bash
# حالة كل شيء
sudo kubectl get all -n abaad

# logs التطبيق
sudo kubectl logs -f deployment/laravel-app -n abaad

# دخول الـ container
sudo kubectl exec -it deployment/laravel-app -n abaad -- sh

# تحديث يدوي بدون CI/CD
sudo kubectl set image deployment/laravel-app \
  laravel=YOURUSERNAME/abaad-app:v1.1 -n abaad
```

---

## ⚠️ تنبيهات مهمة

1. **لا ترفع `k8s/01-secret.yaml` على GitHub** — أضفه لـ `.gitignore`
2. **غيّر `APP_KEY`** — استخدم `php artisan key:generate` دائماً
3. **قاعدة البيانات** — يُفضّل تكون خارج الـ cluster على سيرفر مستقل
