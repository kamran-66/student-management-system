<div class="w-64 min-h-screen bg-gray-700 text-white shadow-lg">
    <div class="p-6 text-2xl font-bold">
        🎓 College Panel
    </div>

    <nav class="mt-4 space-y-2">


               @if(Auth::check() && Auth::user()->role === 'student')
    <!-- Show content for students -->


                    <a href="{{ route('students.studentdashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-user-graduate"></i> Student Dashboard
        </a>
                    @endif


                    <!-- Teacher Links -->
                    @if(Auth::check() && Auth::user()->role === 'teacher')
    <!-- Show content for Teacher -->


                               <a href="{{ route('teachers.teacherdashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-user-graduate"></i> Teacher Dashboard
        </a>
                    @endif

                    
                   @if(Auth::check() && Auth::user()->role === 'admin')
    <!-- Show content for Admin -->


                    
                    <a href="{{ route('admin.admindashboard') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-user-graduate"></i> Admin
        </a>
        <a href="{{ route('students.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-user-graduate"></i> Students
        </a>
        <a href="{{ route('students.stcourse') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-user-graduate"></i> Select Courses
        </a>

        <a href="{{ route('teachers.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-chalkboard-teacher"></i> Teachers
        </a>

        <a href="{{ route('sections.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-book-open"></i> Sections
        </a>
        <a href="{{ route('year.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-book-open"></i> Batch Year
        </a>
        <a href="{{ route('courses.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-book-open"></i> Courses
        </a>

        <a href="{{ route('category.dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-white/10 rounded-lg">
            <i class="fas fa-layer-group"></i> Programs
        </a>
        @endif

    </nav>
</div>
