#!/bin/bash
# ─────────────────────────────────────────────────────────────────
# سكريبت النشر بالترتيب الصحيح
# شغّله من السيرفر السعودي (Master node) بعد تعديل كل ملفات Secret
# الاستخدام: sudo bash deploy.sh
# ─────────────────────────────────────────────────────────────────
set -e

echo "1/7 — إنشاء الـ namespace"
kubectl apply -f k8s/00-namespace.yaml

echo "2/7 — إنشاء بيانات MySQL السرية"
kubectl apply -f k8s/10-mysql-secret.yaml

echo "3/7 — إعدادات MySQL (ConfigMap)"
kubectl apply -f k8s/11-mysql-configmap.yaml

echo "4/7 — تشغيل MySQL (StatefulSet + Service)"
kubectl apply -f k8s/13-mysql-service.yaml
kubectl apply -f k8s/12-mysql-statefulset.yaml

echo "5/7 — الانتظار حتى يصبح MySQL جاهزاً (قد يأخذ دقيقة)..."
kubectl wait --for=condition=ready pod/mysql-0 -n abaad --timeout=120s

echo "6/7 — تشغيل تطبيق Laravel"
kubectl apply -f k8s/01-secret.yaml
kubectl apply -f k8s/03-pvc.yaml
kubectl apply -f k8s/02-deployment.yaml
kubectl apply -f k8s/04-service.yaml
kubectl apply -f k8s/05-ingress.yaml

echo "7/7 — انتظار جاهزية التطبيق..."
kubectl rollout status deployment/laravel-app -n abaad --timeout=120s

echo ""
echo "✅ كل شيء جاهز. تحقق بهذا الأمر:"
echo "   kubectl get all -n abaad"
echo ""
echo "لتشغيل migrations الآن:"
echo "   kubectl apply -f k8s/06-migrate-job.yaml"
