
from django.contrib import admin
from django.urls import path,include

urlpatterns = [
	path('books/', include('LMS1.API.books.urls')),
	path('native/', include('LMS1.API.native.urls')),
	path('users/', include('LMS1.API.users.urls')),
    path('admin/', admin.site.urls),
]
