const { execSync } = require('child_process');
const envs = {
    'APP_DEBUG': 'true',
    'VIEW_COMPILED_PATH': '/tmp',
    'APP_CONFIG_CACHE': '/tmp/config.php',
    'APP_ROUTES_CACHE': '/tmp/routes.php',
    'APP_SERVICES_CACHE': '/tmp/services.php',
    'APP_PACKAGES_CACHE': '/tmp/packages.php',
    'APP_EVENTS_CACHE': '/tmp/events.php',
    'SESSION_DRIVER': 'cookie',
    'LOG_CHANNEL': 'stderr',
    'CACHE_STORE': 'array',
    'DATABASE_URL': 'postgresql://postgres.ppheyurjnjdylspoezog:JlLsuK378dyBbhcQ@aws-1-ap-northeast-1.pooler.supabase.com:6543/postgres',
    'APP_KEY': 'base64:cTEqtbREdpJSSxfVeOuvMl2ZQSFjEhS53YWeLKGG7CY='
};

for (const [key, val] of Object.entries(envs)) {
    console.log(`Adding ${key}...`);
    execSync(`npx vercel env add ${key} production`, { input: val });
}
